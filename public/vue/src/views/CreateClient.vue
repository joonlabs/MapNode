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
            <option>Sehr Fern</option>
            <option>Fern</option>
            <option>Nah</option>
            <option>Sehr Nah</option>
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
      if(zoom === "Sehr Nah") zoom = 16
      if(zoom === "Nah") zoom = 14
      if(zoom === "Fern") zoom = 12
      if(zoom === "Sehr Fern") zoom = 10


      lat = parseFloat(lat.replace(",","."))
      long = parseFloat(long.replace(",","."))

      jClient.createClient(name,zoom,lat,long)

    }
  }
}
</script>

<style scoped>

</style>