import { createRouter, createWebHistory } from 'vue-router';
import LoginScreen from './pages/LoginScreen.vue';
console.log('aw2');
const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/login', name: 'login', component: LoginScreen },
        /*{
            path: '/', component: TheHeader, meta: { requireAuth: true }, children: [
                { path: 'dashboard', name: 'dashboard', component: TheDashboard },
                { path: 'surveys', component: TheSurvey },
                { path: "surveys/create", name: "SurveyCreate", component: SurveyView },
                { path: "surveys/:id", name: "SurveyView", component: SurveyView },
            ]
        },*/
    ]
});

router.beforeEach((to, _, next) => {
    if (to.meta.requireAuth && !store.getters.token) {
        next({ name: 'login' });
    }
    else if (to.meta.isGuest && store.getters.token) {
        next({ name: 'dashboard' });
    }
    else {
        next();
    }
})

export default router;



