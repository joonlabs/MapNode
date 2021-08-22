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
      paginationSize: 20,         //allow 7 rows per page of data
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
      locale:true,
      langs: {
        "de-de": {
          "columns": {
            "name": "Name", //replace the title of column name with the value "Name"
          },
          "ajax": {
            "loading": "Lädt", //ajax loader text
            "error": "Fehler", //ajax error text
          },
          "groups": { //copy for the auto generated item count in group header
            "item": "Mandant", //the singular  for item
            "items": "Mandanten", //the plural for items
          },
          "pagination": {
            "page_size": "Anzahl", //label for the page size select element
            "page_title": "Show Page",//tooltip text for the numeric page button, appears in front of the page number (eg. "Show Page" will result in a tool tip of "Show Page 1" on the page 1 button)
            "first": "Erste Seite", //text for the first page button
            "first_title": "Erste Seite", //tooltip text for the first page button
            "last": "Letzte Seite",
            "last_title": "Letzte Seite",
            "prev": "Zurück",
            "prev_title": "Vorherige Seite",
            "next": "Vor",
            "next_title": "Nächste Seite",
            "all": "Alle",
          },
        }
      }
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