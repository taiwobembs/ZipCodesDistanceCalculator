<template>
  <nav>
    <v-navigation-drawer v-bind:value="leftDrawer" app>

      <v-list dense active-class="border">
        <v-list-item class="leftNavs">
          <v-list-item-action>
            <i class="fa fa-map-marker fa-4x iconlight"></i>
          </v-list-item-action>
          <v-list-item-content>
            <router-link class="leftNavText" to="/">Distance ZipCode</router-link>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app color="blue" dark>
      <v-app-bar-nav-icon @click.stop="toogleLeftDrawer"></v-app-bar-nav-icon>
      <v-toolbar-title>{{ getAppName }}</v-toolbar-title>
    </v-app-bar>
  </nav>
</template>

<script>
import store from "../../store";
import { mapState } from "vuex";

export default {
  name: "NavTop",
  data: () => ({
  }),
  created: function() {
  },
  computed: mapState({
    leftDrawer: state => state.leftNavDrawerStore.leftDrawer,
    getLeftDrawer() {
      return store.state.leftNavDrawerStore.leftDrawer;
    },
    getAppName() {
      return store.state.commonStore.appName;
    }
  }),
  methods: {
    toogleLeftDrawer: function(event) {
      console.log("ToogleLeftDrawer ", event);
      store.commit("toogleLeftDrawer");
    }
  }
};
</script>

<style scoped>

#nav{
  background-color: #ffffff;
}

#nav h2{
  font-size: 1em;
  font-weight: bold;
  float: left;
}

#navListing{
  list-style-type: none;
  clear: both;
  margin-left: -15%;
}

#navListing > li{
  font-size: 0.5em;
  text-align: left;
  margin-bottom: 10px;
  padding: 3%;
}

#navListing > li > a > span{
  float: right;
  color: #c0c0c0;
  vertical-align: middle;
}

#navListing > li:hover{
  background-color: #cfcfcf;
}

nav {
  box-shadow: 3px 0px 3px #c0c0c0;
}

.leftNavs {
  background-color: #03a9fc;
  color: #ffffff;
  margin-bottom: 10px;
}

.leftNavs:hover {
  box-shadow: 5px 5px 5px #333333;
  border: 1px dotted #ffffff;
}

.iconlight {
  color: #ffffff;
}

.iconlight:hover {
  color: #ffff00;
}
</style>
