<template>
    <div class="content-wrapper">
    <a-card title="Tài khoản" style="width: 100%">
      <div class="row">
        <div class="mb-3 col-12 d-flex justify-content-end">
          <router-link to="">
            <a-button type="primary">
              <plus-outlined />
            </a-button>
          </router-link>
        </div>
        <div class="col-12 float-right">
          <a-table :dataSource="categories" :columns="columns" :scroll="{ x: 576 }">
            <template #bodyCell="{ column, index, record }">
              <template v-if="column.key === 'index'">
                <span>{{ index + 1 }}</span>
              </template>

              <template v-if="column.key === 'status'">
                <span v-if="record.status_id == 1" class="text-primary">{{
                  record.status
                }}</span>
                <span v-else-if="record.status_id == 2" class="text-danger">{{
                  record.status
                }}</span>
              </template>

              <template v-if="column.key === 'action'">
                <router-link :to="{ name: 'admin-categories-edit', params: { id: record.id } }">
                  <a-button type="primary"> <edit-outlined /> </a-button>
                </router-link>
              </template>
            </template>
          </a-table>
        </div>
      </div>
    </a-card>
    </div>
  </template>

  <script>
  import { defineComponent, ref } from "vue";
  import { PlusOutlined, EditOutlined } from "@ant-design/icons-vue";
  import axios from "axios";
  export default {
    components: {
      PlusOutlined,
      EditOutlined,
    },
    setup() {

      const categories = ref([]);
      const columns = [
        {
          title: "#",
          key: "index",
        },
        {
          title: "ID",
          dataIndex: "id",
          key: "id",
        },
        {
          title: "Tên danh mục",
          dataIndex: "name",
          key: "name",
        },
        {
          title: "Slug",
          dataIndex: "slug",
          key: "slug",
        },
      ];

      const getCategories = () => {
        axios
          .get("http://127.0.0.1:8000/api/admins/categories")
          .then(function (response) {
            categories.value = response.data;
          })
          .catch(function (error) {
            console.log(error);
          });
      };
      getCategories();
      return {
        categories,
        columns,
      };
    },
  };
  </script>
