<template>
    <div>
        <div class="main small">
            <h2>Erfolgreich abgemeldet</h2>
            <div class="textNormal mB">
                Sie haben sich erfolgreich abgemeldet. Ihre Sitzung wurde
                beendet und alle lokalen und temporären Speicher aufgeräumt.
                <br><br>
                <b>Sie können dieses Fenster nun schliessen.</b>
            </div>
            <div class="button mT ripple" @click="$router.push('/login/')"><span class="icon-log-in"></span> Zum Login</div>
        </div>
    </div>
</template>

<script>

export default {
    name: "LoggedOut",
}
</script>

<style scoped>

</style>
