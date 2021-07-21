<template>

    <tr>
      <th scope="row">{{ product.id }}</th>
            <td>{{ product.name }}</td>
            <td>{{ product.details }}</td>
            <td><img style="height: 30px; width: 30px" :src="'http://127.0.0.1:8000' + product.product_file"></td>
            <td><button class="btn btn-danger" @click = "onDelete">Delete</button></td>
    </tr>

</template>

<script>
export default {
  name: "Product",
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

<style scoped>

</style>
