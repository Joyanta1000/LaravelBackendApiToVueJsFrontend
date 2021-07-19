<template>
  <div class="product_list">



<table class="table">
  <thead class="thead-dark">
    <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Product Details</th>
            <th>Product File</th>
            <th>Action</th>
        </tr>
  </thead>
  <tbody>
  <Product v-for="product in products" :key="product.id" :product= "product" @onDelete="onDelete"/>
    
  </tbody>
</table>

  </div>
</template>

<script>

import Product from "./Product.vue";

export default {
  name: "Product_List",
  components: {
    Product
  },
  props: {
  products: {
    type: Array
  }
  },
  methods: {
  onDelete(id) {
  this.$emit("onDelete", id);
  }
  }
};
</script>

<style scoped>

</style>
