<template>
    <div class="col-md-10 ml-sm-auto px-4 shop-main">
        <div class="pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Products</h1>
        </div>
        <div class="container">
            <div class="row">
                <shop-product v-for="(product, id) of products" :key="id" :product="product"></shop-product>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ShopMain",
    props: {
        products: Array,
        required: true
    },
}
</script>

<style scoped>

</style>
