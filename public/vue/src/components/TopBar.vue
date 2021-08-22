<template>
        <div id="topBar" class="row">
            <div id="topBarHeader" class="textHeader">
                {{title}}
            </div>
        <!--
        <div id="darkMode" :class="darkModeIcon" @click="toggleDarkMode()"></div>
         -->
        </div>
</template>

<script>

export default {
    name: "TopBar.vue",
    data(){
        return {
            title : window.topbar.title,
        }
    },
}
</script>

<style scoped>

</style>
