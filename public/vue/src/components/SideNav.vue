<template>
    <div class="sidenav">
        <div class="logoHolder">
            <img src="../assets/images/Logo.svg" class="logo mBB" id="appLogo">
        </div>
        <!-- SIDENAV -->
        <label for="navToggler" id="navTogglerIcon" class="menuButton ripple icon-menu"></label>
        <input id="navToggler" type="checkbox" class="hide"> <!-- replace ">" with "checked>" for open menu -->
        <div>
            <!--<div class="profilepic">MM</div>
            <div class="profilename mT">Max Mustermann</div>
            <div class="centerButtonInside">
                <div class="button center ripple mTT">Dokumente Hochladen</div>
            </div>
            -->
            <div id = "nav" class="menu mTT">
                <ul>
                    <router-link to="/clients/" v-slot="{ href, isActive, isExactActive }" custom>
                        <li :class="[isActive && 'router-link-active', isExactActive && 'router-link-exact-active']" @click="navigateTo(href)">
                            <span class="icon-credit-card"></span>
                            Mandanten
                        </li>
                    </router-link>
                    <router-link to="/logout/" v-slot="{isActive, isExactActive}" custom>
                        <li :class="[isActive && 'router-link-active', isExactActive && 'router-link-exact-active', 'last']" @click="logout()">
                            <span class="icon-log-out"></span>
                            Logout
                        </li>
                    </router-link>
                </ul>
            </div>
        </div>
        <!-- END-SIDENAV -->
    </div>
</template>

<script>
import router from "../router";
import {jMenu} from "../js/jMenu";
import {jUser} from "@/js/jUser";

export default {
    name: "SideNav",
    methods: {
        navigateTo(routePath, param = "") {
            router.push({ path: routePath + param });
        },
        logout(){
          // this logs out the user
          jUser.logOut()
          this.navigateTo("/logout");
        }
    },
    mounted() {
        jMenu.init()
    }
}
</script>

<style scoped>

</style>
