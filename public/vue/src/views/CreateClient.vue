<template>
  <div class="onlyMainContent">
    <TopBar></TopBar>
    <SideNav></SideNav>
    <div class="main">
      <h2 class="mBB">Neuer Mandant</h2>
      <!-- Titel -->
      <div class="goodRow two mTH">
        <div>
          <label for="name">Name</label>
          <input id="name" class="" type="text" placeholder="Name"/>
        </div>
        <div>
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
          <label for="lat">Latitude</label>
          <input id="lat" class="" type="text" placeholder="">
        </div>
        <div>
          <label for="long">Longitude</label>
          <input id="long" class="" type="text" placeholder="">
        </div>
     </div>
      <div class="button mT" @click="createClient"><span class="icon-check"></span> Mandant erstellen</div>
    </div>
  </div>
</template>

<script>
import TopBar from "@/components/TopBar";
import SideNav from "@/components/SideNav";
import {jClient} from "@/js/jClient";

export default {
  name: "CreateClient.vue",
  components: {TopBar, SideNav},
  methods: {
    createClient() {
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

      jClient.createClient(name,zoom,lat,long)

    }
  }
}
</script>

<style scoped>

</style>