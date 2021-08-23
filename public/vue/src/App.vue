<template>
  <router-view></router-view>
</template>

<script>

export default {
  name: 'App',
  components: {
  }
}
</script>

<style>
@import './assets/css/general.css';
@import './assets/css/container.css';
@import './assets/css/form.css';
@import './assets/css/button.css';
@import './assets/css/icons.css';
@import './assets/css/sidenav.css';
@import './assets/css/tabulator.css';

:root {
  --background-color: rgb(254, 254, 254);
  --background-color-darkmode: rgb(20, 20, 20);
  --font-color: #000;
  --grey-color: #999999;
  --warning-color: #d90000;
  --accent-color: #236EFC;
  /* as css breakpoints do not support variables, this variables are just here for notice:
      --breakpoint-tablet: 1200px;
      --breakpoint-smartphone: 768px;
   */
}
</style>
