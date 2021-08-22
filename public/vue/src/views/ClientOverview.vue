<template>
  <div class="onlyMainContent">
    <TopBar></TopBar>
    <SideNav></SideNav>
    <div class="main">
      <div class="button ripple fRight" @click="navigateTo('/createClient')"><span class="icon-plus"></span> Neuen Mandanten erstellen</div>
      <h2 class="mBB">Alle Mandanten</h2>
      <div id="client-table"></div>
    </div>
  </div>
</template>

<script>
import TopBar from "@/components/TopBar";
import SideNav from "@/components/SideNav";
import Tabulator from 'tabulator-tables';
import router from "@/router";
import {jClient} from "@/js/jClient";

export default {
  name: "ClientOverview.vue",
  components: {TopBar, SideNav},
  data () {
    return {
      clients : []
    }
  },
  async mounted () {
    let _this = this
    //load table data
    _this.clients = await jClient.getClients()

    new Tabulator("#client-table", {
      data: _this.clients,           //load row data from array
      layout: "fitColumns",      //fit columns to width of table
      responsiveLayout: "hide",  //hide columns that dont fit on the table
      tooltips: true,            //show tool tips on cells
      addRowPos: "top",          //when adding a new row, add it to the top of the table
      history: false,             //allow undo and redo actions on the table
      pagination: "local",       //paginate the data
      paginationSize: 10,         //allow 7 rows per page of data
      movableColumns: false,      //allow column order to be changed
      resizableRows: false,       //allow row order to be changed
      initialSort: [             //set the initial sort order of the data
        { column: "id", dir: "asc"},
      ],
      columns:[                 //define the table columns
        {title:"ID", field:"id"},
        {title:"Name", field:"name"},
      ],
      rowClick:function(e, row){ //trigger an alert message when the row is clicked
        _this.navigateTo("/clients/" + row.getData().id);
      },
    });
  },
  methods: {
    //Method to navigate to another page
    navigateTo(routePath, param = "") {
      router.push({ path: routePath + param });
    },
  }
}


</script>

<style scoped>

</style>