const admin = [{
    path   : '/admins',
    component: () => import('../layouts/admin.vue'),
    children: [
        {
            path: 'categories',
            name: 'admin-category',
            component: () => import('../pages/admin/category/index.vue')
        },
        {
            path: 'categories/create',
            name: 'admin-category-create',
            component: () => import('../pages/admin/category/create.vue')
        },
        {
            path: 'product',
            name: 'admin-product',
            component: () => import('../pages/admin/product/index.vue')
        },
        {
            path: 'product/create',
            name: 'admin-product-create',
            component: () => import('../pages/admin/product/create.vue')
        },

    ]
}]

export default admin
