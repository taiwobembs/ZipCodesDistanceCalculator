<template>
  <section style="width: 100%">
    <NavMain />
    <v-content style="clear: both;padding: 2%;margin:0;width: 100%">
      <h1 class="subHeading middle">Calculate ZipCodes Distance</h1>
      <sweetalert-icon icon="loading" v-show="showLoadingIcon" />

      <v-row justify="center">
        <v-dialog v-model="dialogCallResponse" persistent max-width="290">
          <v-card>
            <v-alert v-show="showSuccessIcon" dense text type="success">
              <strong>{{calculatedDistance}} Miles</strong>
            </v-alert>
            <sweetalert-icon icon="success" v-show="showSuccessIcon" />
            <v-alert v-show="showErrorIcon" dense text type="error">
              Error While Creating voter
              <strong>Failed</strong>
            </v-alert>
            <sweetalert-icon icon="error" v-show="showErrorIcon" />
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="green darken-1" text @click="dialogCallResponse = false">Close</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
      
      <section style="width: 100%;display:block;"><br>
          <section style="width: 40%;float:left;margin-right: 5%;">
              <v-select
              v-model="selectFrom"
              :items="items"
              label="From ZipCode"
              required
              @change="$v.select.$touch()"
              @blur="$v.select.$touch()"
              ></v-select>
            </section>
            <section style="width: 40%;float:left">
              <v-select
              v-model="selectTo"
              :items="items"
              label="To Zipcode"
              required
              @change="$v.select.$touch()"
              @blur="$v.select.$touch()"
              ></v-select>
            </section>
            <v-btn v-on:click="calculateDistance()" type="submit" color="primary">Calculate</v-btn>
          <section class="clearfix"></section>  

      </section>
    </v-content>
    <Footer />
  </section>
</template>

<script>
import store from "../store";
import NavMain from "../components/Navs/NavMain.vue";
import Footer from "../components/Footers/Footer.vue";
import { appMixin } from "../mixins/appMixin.js";
import axios from "axios";

export default {
  name: "Dashboard",
  mixins: [appMixin],
  components: {
    NavMain,
    Footer
  },
  created: function() {
    let vmObjectInstance = this;
    
    axios
      .get(this.getZipCodesUrlEndpoint)
      .then(function(response) {
        if (JSON.stringify(response.data) !='{}') {
          vmObjectInstance.searchResults = response.data.data;

          for (let zipcode in vmObjectInstance.searchResults) {
            vmObjectInstance.items.push(vmObjectInstance.searchResults[zipcode].zipcode)
          }
          vmObjectInstance.showLoadingIcon = false;
          vmObjectInstance.showSearchResults = true;
        }
      })
      .catch(function(error) {
        console.error(error);
      });
  },
  data: () => ({
    getZipCodesUrlEndpoint: store.state.urlStore.baseUrl + store.state.urlStore.getZipCodesUrl,
    calculateDistanceWithZipCodesUrlEndpoint: store.state.urlStore.baseUrl + store.state.urlStore.calculateDistanceWithZipCodesUrl,
    searchResults: [],
    showLoadingIcon: true,
    showSearchResults: false,
    selectFrom: null,
    selectTo: null,
    items: [],
    calculatedDistance: 0,
    showErrorIcon: false,
    showSuccessIcon: false,
    dialog: false,
    dialogCallResponse: false,
    objectToSend: {
      zipcodes1: null,
      zipcodes2: null,
    },
  }),
  computed: {
    getAppName() {
      return store.state.commonStore.appName;
    }
  },
  methods: {
    calculateDistance(){
      let vmObjectInstance = this;

      if(this.selectFrom != null && this.selectTo != null){
        this.objectToSend.zipcodes1 = this.selectFrom;
        this.objectToSend.zipcodes2 = this.selectTo;
        let headers = this.objectToSend;

        axios
        .post(this.calculateDistanceWithZipCodesUrlEndpoint, headers)
        .then(function(response) {
          vmObjectInstance.dialog = false;
          if (response.data.responseCode === store.state.successCode) {
            vmObjectInstance.calculatedDistance = response.data.data.distanceReturned;

            vmObjectInstance.dialogCallResponse = true;
            vmObjectInstance.showSuccessIcon = true;
            vmObjectInstance.showErrorIcon = false;
            setTimeout(() => {
              this.$v.$reset();
            }, store.state.alertLongTimeout);
          } else {
            vmObjectInstance.dialogCallResponse = true;
            vmObjectInstance.showErrorIcon = true;
            vmObjectInstance.showSuccessIcon = false;
            // vmObjectInstance.serverReturnedErrors = `${response.data.errors.email}  ${response.data.errors.name}`;
          }
        })
        .catch(function(error) {
          console.error(error);
          vmObjectInstance.dialog = false;
          vmObjectInstance.dialogCallResponse = true;
          vmObjectInstance.showErrorIcon = false;
          vmObjectInstance.showSuccessIcon = false;
        });
      }
      return null;
    }
  }
};
</script>

<style scoped>

.subHeading{
  color: #000000;
  font-size: 1.2em;
  text-align: left;
  margin: 20px 0;
  font-weight: 300;
}

.clearfix{
  clear: both;
}

.middle{
  text-align: center
}


.searchListings > article{
  width: 22.9%;
  height: 230px;
  box-shadow: 0px 2px 6px rgb(33 33 38 / 12%);
  float: left;
  padding: 1%;
  margin: 10px 20px 20px 10px;
}


.searchListings > article:hover{
  box-shadow: 0px 2px 6px rgb(33 33 38 / 62%);
}

.searchListings > article > h2{
  text-align: left;
  font-size: 1em;
  margin-top: 20px;
}

.searchListings > article > span{
  color: #c0c0c0;
  font-size: 0.7em;
  margin-top: -10px;
  float: left;
}

</style>