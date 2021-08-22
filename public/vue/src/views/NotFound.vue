<template>
    <div>
        <div class="main">
            <h2>Hoppla...</h2>
            <div class="textNormal mB">
                Die Seite die Sie versuchen zu erreichen, existiert nicht. Bitte überprüfen Sie die URL und versuchen es erneut.
            </div>
            <div class="button mT ripple" @click="$router.go(-1)"><span class="icon-arrow-left"></span> Zurück</div>
        </div>
    </div>
</template>

<script>

export default {
    name: "NotFound",
}
</script>

<style scoped>

</style>
