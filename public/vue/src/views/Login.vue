<template>
  <div>
    <div class="main small">
      <h2>Anmelden</h2>
      <label for="email" >E-Mail-Adresse:</label>
      <input id="email" class="mB" type="email" placeholder="E-Mail-Adresse" autocapitalize="none" autocomplete="off" autocorrect="off"/>
      <label for="password">Passwort:</label>
      <input id="password" class="mB" type="password" placeholder="Passwort" @keyup="keyup"/>
      <button type="button" @click="login()">Anmelden</button>
    </div>
  </div>
</template>

<script>

import {jUser} from "@/js/jUser";

export default {
  name: "Login",
  methods: {
    keyup(event) {
      if(event.keyCode === 13){
        this.login()
      }
    },
    login() {
      let email = document.getElementById("email").value
      let password = document.getElementById("password").value

      // check for email
      if(email.trim()===""){
        return
      }

      // check for password
      if(password.trim()===""){
        return
      }
      jUser.logIn({email: email, password: password})
    }
  }
}
</script>

<style scoped>

</style>
