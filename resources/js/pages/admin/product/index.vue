<template>
  <div class="content-wrapper">
    <div class="products__list table my-3">
      <div class="customers__titlebar dflex justify-content-between align-items-center">
        <div class="customers__titlebar--item">
          <h1 class="my-1">Products</h1>
        </div>
        <div class="customers__titlebar--item">
          <router-link :to="{ name: 'admin-product-create' }">
            <button class="btn btn-secondary my-1">Add Product</button>
          </router-link>
        </div>
      </div>

      <div
        class="table--heading mt-2 products__list__heading"
        style="padding-top: 20px; background: #fff"
      >
        <!-- <p class="table--heading--col1">&#32;</p> -->
        <p class="table--heading--col1">image</p>
        <p class="table--heading--col2">Product</p>
        <p class="table--heading--col4">Type</p>
        <p class="table--heading--col3">Inventory</p>
        <!-- <p class="table--heading--col5">&#32;</p> -->
        <p class="table--heading--col5">actions</p>
      </div>

      <!-- product 1 -->
      <div class="table--items products__list__item">
        <div class="products__list__item--imgWrapper">
          <img class="products__list__item--img" src="1.jpg" style="height: 40px" />
        </div>
        <a href="# " class="table--items--col2"> Product name </a>
        <p class="table--items--col2">type</p>
        <p class="table--items--col3">10</p>
        <div>
          <button class="btn-icon btn-icon-success">
            <i class="fas fa-pencil-alt"></i>
          </button>
          <button class="btn-icon btn-icon-danger">
            <i class="far fa-trash-alt"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
