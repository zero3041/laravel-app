<template>
    <div class="content-wrapper">
    <form @submit.prevent="createUsers()">
        <a-card title="Tạo mới tài khoản" style="width: 100%">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mb-3">
                            <a-avatar shape="square" :size="200">
                                <template #icon>
                                    <img src="../../../assets/users.jpg" alt="users" />
                                </template>
                            </a-avatar>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <a-button type="primary">
                                <plus-outlined />
                                <span> Chọn Ảnh </span>
                            </a-button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-8">
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span :class="{ 'text-danger': errors.status_id }">Tình Trạng:</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-select
                                class="border-fix"
                                show-search
                                placeholder="Tình trạng"
                                style="width: 100%"
                                :options="users_status"
                                :filter-option="filterOption"
                                v-model:value="status_id"
                                :class="{ 'select-danger': errors.status_id }"
                            ></a-select>
                            <div class="a-100"></div>
                            <small v-if="errors.status_id" class="text-danger">{{
                                    errors.status_id[0]
                                }}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span>Tên tài khoản:</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input
                                class="border-fix"
                                v-model:value="username"
                                placeholder="Nhập tên tài khoản"
                                allow-clear
                                :class="{ 'texts-danger': errors.username }"
                            />
                            <div class="a-100"></div>
                            <small v-if="errors.username" class="text-danger">{{
                                    errors.username[0]
                                }}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span>Họ và Tên:</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input
                                class="border-fix"
                                v-model:value="name"
                                placeholder="Nhập Họ và Tên"
                                allow-clear
                                :class="{ 'texts-danger': errors.name }"
                            />
                            <div class="a-100"></div>
                            <small v-if="errors.name" class="text-danger">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span>Email:</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input
                                class="border-fix"
                                v-model:value="email"
                                placeholder="Nhập Email"
                                allow-clear
                                :class="{ 'texts-danger': errors.email }"
                            />
                            <div class="a-100"></div>
                            <small v-if="errors.email" class="text-danger">{{ errors.email[0] }}</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span>Phòng ban:</span>
                            </label>
                        </div>
                        <div class="col-10 col-sm-4 mb-3">
                            <a-select
                                class="border-fix"
                                show-search
                                placeholder="Phòng ban"
                                style="width: 100%"
                                :options="departments"
                                :filter-option="filterOption"
                                v-model:value="department_id"
                                :class="{ 'select-danger': errors.department_id }"
                            >
                            </a-select>
                            <div class="a-100"></div>
                            <small v-if="errors.department_id" class="text-danger">{{
                                    errors.department_id[0]
                                }}</small>
                        </div>
                        <div class="col-2 col-sm-1">
                            <a-button type="primary">
                                <plus-outlined />
                            </a-button>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span>Mật khẩu</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input-password
                                class="border-fix"
                                v-model:value="password"
                                placeholder="Password"
                                allow-clear
                                :class="{ 'texts-danger': errors.password }"
                            />
                            <div class="a-100"></div>
                            <small v-if="errors.password" class="text-danger">{{
                                    errors.password[0]
                                }}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span>Nhập lại mật khẩu</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input-password
                                class="border-fix"
                                v-model:value="password_confirmation"
                                placeholder="Re Password"
                                allow-clear
                                :class="{ 'texts-danger': errors.password }"
                            />
                            <div class="a-100"></div>
                            <small v-if="errors.password" class="text-danger">{{
                                    errors.password[0]
                                }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-grid d-sm-flex justify-content-sm-end mx-auto">
                    <a-button class="me-sm-2 me-0 mb-3 mb-sm-0">
                        <router-link :to="{ name: 'admin-users' }">
                            <span>Huỷ</span>
                        </router-link>
                    </a-button>
                    <a-button type="primary" htmlType="submit">
                        <span>Lưu</span>
                    </a-button>
                </div>
            </div>
        </a-card>
    </form>
    </div>
</template>
<script>
import { defineComponent, ref, reactive, toRefs } from "vue";
import { message } from "ant-design-vue";
import { useRouter } from "vue-router";
import { PlusOutlined } from "@ant-design/icons-vue";
import axios from "axios";

export default defineComponent({
    components: {
        PlusOutlined,
    },
    setup() {
        const router = useRouter();
        // useMenu().selectedKeys(["admin-users"]);
        const users_status = ref([]);
        const departments = ref([]);

        const createUsers = () => {
            axios
                .post("http://127.0.0.1:8000/api/users", users)
                .then((response) => {
                    if (response) {
                        message.success("Thêm mới tài khoản thành công!");
                        router.push({ name: "admin-users" });
                    }
                })
                .catch((error) => {
                    // console.log(error);
                    errors.value = error.response.data.errors;
                });
        };

        const users = reactive({
            username: "",
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            department_id: [],
            status_id: [],
        });

        const errors = ref({});

        const getUsersCreate = () => {
            axios
                .get("http://127.0.0.1:8000/api/users/create")
                .then((response) => {
                    users_status.value = response.data.users_status;
                    departments.value = response.data.departments;
                })
                .catch((error) => console.log(error));
        };
        getUsersCreate();

        const filterOption = (input, option) => {
            return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
        };

        return {
            users_status,
            departments,
            ...toRefs(users),
            filterOption,
            createUsers,
            errors,
        };
    },
});
</script>

<style>
.select-danger {
    border: 1px solid red;
    border-radius: 6px;
}
.border-fix {
    border-radius: 0px !important;
    box-sizing: border-box;
    line-height: 1.5714285714285714;
}
.texts-danger {
    border: 1px solid red;
}
</style>
