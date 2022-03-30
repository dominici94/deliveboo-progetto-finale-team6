import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

// import Header from "./components/macro/Header.vue";
import Landing from "./pages/Landing";
import Home from "./pages/Home";
import SingleRestaurant from "./pages/SingleRestaurant";
import CheckoutHome from "./pages/CheckoutHome";
import CheckoutSuccess from "./pages/CheckoutSuccess";
import PageNotFound from "./pages/PageNotFound";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "landing",
            component: Landing
        }, ,
        {
            path: "/home",
            name: "home",
            component: Home
        },
        {
            path: "/home/checkout",
            name: "checkout",
            component: CheckoutHome
        },
        {
            path: "/home/checkout-success",
            name: "checkout-success",
            component: CheckoutSuccess
        },
        {
            path: "/home/:slug",
            name: "single-restaurant",
            component: SingleRestaurant
        },
        {
            path: "*",
            name: "page-404",
            component: PageNotFound
        }
    ]
});

export default router