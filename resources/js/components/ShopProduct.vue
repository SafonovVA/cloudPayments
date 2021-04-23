<template>
    <div class="col-sm shop-product" v-show="showProduct">
        <div class="card" style="width: 12rem;">
            <img :src="product.image" class="card-img-top" alt="shop" height="150px" width="">
            <div class="card-body">
                <h5 class="card-title">{{ product.name }}</h5>
                <div>{{ defaultExchange }} <b>{{ productPrice }}</b></div>
                <a href="#" class="btn btn-light float-right">Buy</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ShopProduct",
    props: {
        product: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            showProduct: true,
            defaultExchange: 'KZT',
            productPrice: this.product.price
        }
    },
    mounted() {
        let self = this;

        this.$root.$on('showAllProducts', function() {
            self.showProduct = true;
        });

        this.$root.$on('showProductsByCategoryId', function(arrayOfId) {
            self.showProduct = !!arrayOfId.includes(+self.product.category_id);
        });

        this.$root.$on('setExchangeValues', function(data) {
            if (data.title === 'RUB') {
                self.defaultExchange = data.title;
                self.productPrice /= data.value;
            } else {
                self.defaultExchange = 'KZT';
                self.productPrice = self.product.price;
            }
        });
    },
    watch: {
        productPrice: function() {
            this.productPrice = (+this.productPrice).toFixed(2);
        }
    }
}
</script>

<style scoped>

</style>
