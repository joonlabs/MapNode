<template>
  <div class="onlyMainContent">
    <TopBar></TopBar>
    <SideNav></SideNav>
    <div class="main">
      <div class="button mT fRight"
           @click=exportClient><span class="icon-download"></span>
       Mandant exportieren
      </div>
      <h2 class="mBB">Mandant</h2>
      <!-- Name -->
      <div class="goodRow two mTH">
        <div>
          <label for="name">Name</label>
          <input id="name" class="" type="text" placeholder="Name"/>
        </div>
        <div>
          <!-- Zoom -->
          <label for="zoom">Zoom</label>
          <select id="zoom">
            <option>Detailliert (18)</option>
            <option>Detailliert (17)</option>
            <option>Sehr Nah (16)</option>
            <option>Sehr Nah (15)</option>
            <option>Nah (14)</option>
            <option>Nah (13)</option>
            <option>Fern (12)</option>
            <option>Fern (11)</option>
            <option>Sehr Fern (10)</option>
            <option>Sehr Fern (9)</option>
          </select>
        </div>
      </div>
      <div class="goodRow two mTH">
        <div>
          <!-- Latitude -->
          <label for="lat">Latitude</label>
          <input id="lat" class="" type="text" placeholder="">
        </div>
        <div>
          <!-- Longitude -->
          <label for="long">Longitude</label>
          <input id="long" class="" type="text" placeholder="">
        </div>
      </div>
      <div class="button mT" @click="updateClient"><span class="icon-check"></span>Mandant aktualisieren</div>
      <!-- Map -->
      <code>&lt;iframe class="map" src="{{url}}/mapnode/{{client.id}}/{{key}}"&gt;</code>
      <div id="map"><iframe class="map" :src="'/mapnode/' + client.id + '/' + key"></iframe></div>

    </div>
  </div>
</template>
<script>
import TopBar from "@/components/TopBar";
import SideNav from "@/components/SideNav";
import {jClient} from "@/js/jClient";
import {jUser} from "../js/jUser";
//import router from "../router";

export default {
  name: "ClientDetail.vue",
  components: {TopBar, SideNav},
  data() {
    return {
      client: {},
      key: window.config.addressomat.key,
      url: "https://" + window.location.hostname,
    }
  },
  async mounted() {
    let _this = this
    //load client
    _this.client = await jClient.getClient(_this.$route.params.id)
    console.log(_this.client)

    //fill client informations in form
    document.getElementById("name").value = _this.client.name
    //Convert Int to Text
    if(_this.client.karte_zoom === 18) _this.client.karte_zoom = "Detailliert (18)"
    if(_this.client.karte_zoom === 17) _this.client.karte_zoom = "Detailliert (17)"
    if(_this.client.karte_zoom === 16) _this.client.karte_zoom = "Sehr Nah (16)"
    if(_this.client.karte_zoom === 15) _this.client.karte_zoom = "Sehr Nah (15)"
    if(_this.client.karte_zoom === 14) _this.client.karte_zoom = "Nah (14)"
    if(_this.client.karte_zoom === 13) _this.client.karte_zoom = "Nah (13)"
    if(_this.client.karte_zoom === 12) _this.client.karte_zoom = "Fern (12)"
    if(_this.client.karte_zoom === 11) _this.client.karte_zoom = "Fern (11)"
    if(_this.client.karte_zoom === 10) _this.client.karte_zoom = "Sehr Fern (10)"
    if(_this.client.karte_zoom === 9) _this.client.karte_zoom = "Sehr Fern (9)"

    document.getElementById("zoom").value = _this.client.karte_zoom
    document.getElementById("lat").value = _this.client.karte_latitude
    document.getElementById("long").value = _this.client.karte_longitude

    //Map for entries

  },
  methods: {
    async updateClient() {
      let _this = this
      let name = document.getElementById("name").value
      let lat = document.getElementById("lat").value
      let long = document.getElementById("long").value
      let zoom = document.getElementById("zoom").value

      if(name.trim() === "") {
        return
      }
      if(lat.trim() === "") {
        return
      }
      if(long.trim() === "") {
        return
      }
      //Convert Text to Int
      if(zoom === "Detailliert (18)") zoom = 18
      if(zoom === "Detailliert (17)") zoom = 17
      if(zoom === "Sehr Nah (16)") zoom = 16
      if(zoom === "Sehr Nah (15)") zoom = 15
      if(zoom === "Nah (14)") zoom = 14
      if(zoom === "Nah (13)") zoom = 13
      if(zoom === "Fern (12)") zoom = 12
      if(zoom === "Fern (11)") zoom = 11
      if(zoom === "Sehr Fern (10)") zoom = 10
      if(zoom === "Sehr Fern (9)") zoom = 9


      lat = parseFloat(lat.replace(",","."))
      long = parseFloat(long.replace(",","."))

      await jClient.updateClient(_this.client.id, name,lat,long,zoom)

      let src = document.querySelector("iframe").src
      document.querySelector("iframe").src = "about:blank"
      document.querySelector("iframe").src = src
    },
    exportClient() {
      let _this = this
      window.location.href = window.config.url + window.config.api.endpoint + "/download/" + _this.client.id + "/" + jUser.getToken()
    },
    /*
    deleteClient() {
      let _this = this
      jClient.deleteClient(_this.client.id)
      router.replace("/clients")
    }
     */
  }
}
</script>

<style scoped>

</style>