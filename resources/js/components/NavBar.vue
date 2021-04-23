<template>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">{{ this.navbarBrandTitle }}</a>
    </nav>
</template>

<script>
export default {
    name: "NavBar",
    props: ['navbarBrandTitle']
}
</script>

<style scoped>

</style>
