<template>
  <div class="content-wrapper">
    <div class="products__create">
      <div
        class="products__create__titlebar dflex justify-content-between align-items-center"
      >
        <div class="products__create__titlebar--item">
          <h1 class="my-1" style="color: Red">Add Product</h1>
        </div>
        <div class="products__create__titlebar--item">
          <button class="btn btn-secondary ml-1">Save</button>
        </div>
      </div>

      <div class="products__create__cardWrapper mt-2">
        <div class="products__create__main">
          <div class="products__create__main--addInfo card py-2 px-2 bg-white">
            <p class="mb-1">Name</p>
            <input type="text" class="input" v-model="name" />
            <p class="mb-1">Sku</p>
            <input type="text" class="input" />

            <p class="my-1">Description (optional)</p>
            <textarea cols="10" rows="5" class="textarea"></textarea>

            <div class="products__create__main--media--images mt-2">
              <div class="clearfix">
                <a-upload
                  v-model:file-list="fileList"
                  list-type="picture-card"
                  @preview="handlePreview"
                >
                  <div v-if="fileList.length < 8">
                    <plus-outlined />
                    <div style="margin-top: 8px">Upload</div>
                  </div>
                </a-upload>
                <a-modal
                  :open="previewVisible"
                  :title="previewTitle"
                  :footer="null"
                  @cancel="handleCancel"
                >
                  <img alt="example" style="width: 100%" :src="previewImage" />
                </a-modal>
              </div>
            </div>
          </div>
        </div>
        <div class="products__create__sidebar">
          <!-- Product Organization -->
          <div class="card py-2 px-2 bg-white">
            <!-- Product unit -->
            <div class="my-3">
              <p>Sizes</p>
              <input type="text" class="input" />
            </div>
            <hr />

            <!-- Product invrntory -->
            <div class="my-3">
              <p>Color</p>
              <input type="text" class="input" />
            </div>
            <hr />

            <!-- Product Price -->
            <div class="my-3">
              <p>Original Price</p>
              <input type="text" class="input" />
            </div>
            <div class="my-3">
              <p>Discounted Price</p>
              <input type="text" class="input" />
            </div>
          </div>
        </div>
      </div>
      <!-- Footer Bar -->
      <div class="dflex justify-content-between align-items-center my-3">
        <p></p>
        <button class="btn btn-secondary" @click="save">Save</button>
      </div>
    </div>
  </div>
</template>

<script>
import { PlusOutlined } from "@ant-design/icons-vue";
import { defineComponent, ref } from "vue";
function getBase64(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = (error) => reject(error);
  });
}
export default defineComponent({
  data: function () {
    return { name: "test" };
  },
  methods: {
    save: async function () {
      this.image = { name: await getBase64(this.fileList[0].originFileObj) };

      axios
        .post("", this.image)
        .then((response) => {
          if (response) {
            message.success("Thêm mới tài khoản thành công!");
            router.push({ name: "admin-users" });
          }
        })
        .catch((error) => {
          console.log(error);
          errors.value = error.response.data.errors;
        });
    },
  },
  components: {
    PlusOutlined,
  },
  setup() {
    const previewVisible = ref(false);
    const previewImage = ref("");
    const previewTitle = ref("");
    const fileList = ref([]);
    const handleCancel = () => {
      previewVisible.value = false;
      previewTitle.value = "";
    };
    const handlePreview = async (file) => {
      if (!file.url && !file.preview) {
        file.preview = await getBase64(file.originFileObj);
      }
      previewImage.value = file.url || file.preview;
      previewVisible.value = true;
      previewTitle.value = file.name || file.url.substring(file.url.lastIndexOf("/") + 1);
    };
    return {
      previewVisible,
      previewImage,
      fileList,
      handleCancel,
      handlePreview,
      previewTitle,
    };
  },
});
</script>
<style>
/* you can make up upload button and sample style by using stylesheets */
.ant-upload-select-picture-card i {
  font-size: 32px !important;
  color: #999;
}

.ant-upload-select-picture-card .ant-upload-text {
  margin-top: 8px !important;
  color: #666;
}
</style>
