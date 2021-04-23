<template>
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                Filters
            </h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Categories
                    </a>
                </li>
                <li class="nav-item pl-3">
                    <a class="nav-link" href="#">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="all" v-model="allCategories">
                            <label class="form-check-label">
                                All
                            </label>
                        </div>

                        <div class="form-check" v-for="category in categories">
                            <input class="form-check-input" type="checkbox" :value="category.id"
                                   v-model="checkedCategories">
                            <label class="form-check-label">
                                {{ category.name }}
                            </label>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    name: "SideBar",
    props: {
        categories: Array,
        required: true
    },
    data() {
        return {
            allCategories: true,
            checkedCategories: []
        }
    },
    watch: {
        allCategories: function () {
            if (this.allCategories === true && this.checkedCategories.length !== 0) {
                this.checkedCategories = [];
                this.$root.$emit('showAllProducts');
            }

        },
        checkedCategories: function () {
            if (this.allCategories === true && this.checkedCategories.length !== 0) {
                this.allCategories = false;
                this.$root.$emit('showProductsByCategoryId', this.checkedCategories);
            } else if (this.checkedCategories.length !== 0) {
                this.$root.$emit('showProductsByCategoryId', this.checkedCategories);
            } else if (this.checkedCategories.length === 0) {
                this.allCategories = true;
                this.$root.$emit('showAllProducts');
            }

        },
    }
}
</script>

<style scoped>

</style>
