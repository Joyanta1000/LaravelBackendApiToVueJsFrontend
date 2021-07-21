<template>

<div class="product_list">

<div class="container">
  <div class="row">
    <div class="col-md-4" v-for="product in products" :key="product.id" :product= "product">
      <div class="thumbnail">
        <a :href="'http://127.0.0.1:8000' + product.product_file" target="_blank">
          <img :src="'http://127.0.0.1:8000' + product.product_file" alt="Lights" style="width:100%">
          <div class="caption">
            <h3>{{ product.name }}</h3>
            <p>{{ product.details }}</p>
          </div>
        </a>
      </div>
    </div>
    <!-- <div class="col-md-4">
      <div class="thumbnail">
        <a href="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg" target="_blank">
          <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg" alt="Nature" style="width:100%">
          <div class="caption">
            <p>Lorem ipsum donec id elit non mi porta gravida at eget metus.</p>
          </div>
        </a>
      </div>
    </div> -->
    <!-- <div class="col-md-4">
      <div class="thumbnail">
        <a href="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg" target="_blank">
          <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg" alt="Fjords" style="width:100%">
          <div class="caption">
            <p>Lorem ipsum donec id elit non mi porta gravida at eget metus.</p>
          </div>
        </a>
      </div>
    </div> -->
  </div>
</div>


</div>





</template>

<script>
  
  export default {
  name: "Home",
  
  props: {
    product: {
        type: Object
    }
  },
  methods: {
  onDelete() {
  this.$emit("onDelete", this.product.id);
  }
  }
};
</script>

<script>

import Product from "./Product.vue";

export default {
  name: "Home",
  components: {
    
  },
  props: {
  products: {
    type: Array
  }
  },
  methods: {
  
  }
};
</script>

