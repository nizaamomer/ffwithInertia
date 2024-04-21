import { defineStore } from 'pinia';
import axios from 'axios';
import { useRouter } from 'vue-router';
const router = useRouter();
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('userToken')}`;
export const useUserStore = defineStore('user', {
    state: () => ({
        user: null,
        token: localStorage.getItem('userToken') || null,
        errors: {},
        error: "",
    }),
    actions: {
        async getUser() {
            try {
                const { data } = await axios.get("/getuser");
                this.user = data.user;
            } catch (error) {
                localStorage.removeItem("userToken");
                // router.push("/login");
            }
        },
        async login(loginForm) {
            try {
                const { data } = await axios.post("/login", loginForm);
                this.user = data.user;
                this.token = data.token;
                localStorage.setItem('userToken', this.token); 
                window.location.reload();
            } catch (e) {
                localStorage.removeItem("userToken");
                if (e.response && e.response.status === 422) {
                    this.errors = e.response.data.errors;
                } else if (e.response && e.response.status === 401) {
                    this.error = e.response.data.message;
                }
            }
        },

        async logout() {
            try {
                await axios.post("/logout");
                localStorage.removeItem('userToken');
                this.user = null;
                this.token = null;
                // router.push("/login");
                // window.location.reload();
            } catch (error) {
                console.error("Logout failed:", error);
            }
        },
    },
    getters: {
        isLoggedIn() {
            return !!this.token;
        },
        isAdmin() {
            return this.user && this.user.isAdmin === 1;
        },
    },
});
