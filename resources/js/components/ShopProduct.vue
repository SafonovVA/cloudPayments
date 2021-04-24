<template>
    <div class="d-flex align-items-stretch p-2" v-show="showProduct">
        <div class="card" style="width: 12rem;">
            <img :src="product.image" class="card-img-top" alt="shop" height="150px" width="">
            <div class="card-body">
                <h5 class="card-title">{{ product.name }}</h5>
                <div v-if="hasProductInStock">In stock {{ product.count }}</div>
                <div v-else>Out of reach</div>
                <div v-if="hasProductInStock">{{ defaultExchange }} <b>{{ productPrice }}</b></div>
                <div class="row" v-if="hasProductInStock">
                    <div class="col-md-8 input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-sm btn-secondary" @click="decreaseProductQuantity">-</button>
                        </div>
                        <input type="text" class="form-control" v-model="productQuantity">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-secondary" @click="increaseProductQuantity">+</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="btn btn-light float-right" @click="pay">Buy</a>
                    </div>
                </div>
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
            productPrice: this.product.price,
            hasProductInStock: +this.product.count > 0,
            productQuantity: 1
        }
    },
    methods: {
        increaseProductQuantity() {
            if (this.productQuantity < +this.product.count) {
                console.log(this.productQuantity);
                this.productQuantity++;
            }
        },
        decreaseProductQuantity() {
            if (this.productQuantity > 1) {
                console.log(this.productQuantity);
                this.productQuantity--;
            }
        },
        decreaseProductQuantityByValue(count) {
            this.productQuantity -= count;
        },
        async pays() {
            console.log('действие при успешной оплате');
            await axios.patch(`/api/purchase-success`, {
                productId: +this.product.id,
                count: +this.productQuantity,
                exchangeTitle: this.defaultExchange,
            });
            window.location.reload();
        },
        pay() {
            const self = this;
            const widget = new cp.CloudPayments();
            widget.pay('charge', // или 'auth'
                { //options
                    publicId: 'test_api_00000000000000000000001', //id из личного кабинета
                    description: 'Оплата товаров в example.com', //назначение
                    amount: +this.productPrice, //сумма
                    currency: this.defaultExchange, //валюта
                    accountId: 'user@example.com', //идентификатор плательщика (необязательно)
                    invoiceId: '1234567', //номер заказа  (необязательно)
                    skin: "mini", //дизайн виджета (необязательно)
                    data: {
                        myProp: 'myProp value'
                    }
                },
                {
                    onSuccess: async function (options) { // success
                        //действие при успешной оплате
                        console.log('действие при успешной оплате');
                        window.location.reload();

                    },
                    onFail: function (reason, options) { // fail
                        console.log('действие при неуспешной оплате');
                        //$('#successPayment').appendTo('body').modal('show');
                    },
                    onComplete: async function (paymentResult, options) {
                        if (paymentResult.success === true) {
                            await axios.patch(`/api/purchase-success`, {
                                productId: +self.product.id,
                                count: +self.productQuantity,
                                exchangeTitle: self.defaultExchange,
                            });
                        }
                        console.log('Вызывается как только виджет получает от api.cloudpayments ответ с результатом транзакции.');
                    }
                }
            )
        },
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
        },
        productQuantity: function() {
            if (this.productQuantity > +this.product.count) {
                this.productQuantity = +this.product.count;
            }
        }
    }
}
</script>

<style scoped>

</style>


