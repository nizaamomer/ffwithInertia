import { defineStore } from 'pinia';

const Offer_STORAGE_KEY = 'offerItems';

export const useOfferCartStore = defineStore('cart', {
    state: () => ({
        cartItems: JSON.parse(localStorage.getItem(Offer_STORAGE_KEY)) || [],
        totalAmount: 0, // Initialize to 0
    }),
    getters: {
        totalItems() {
            return this.cartItems.length;
        },
        totalAmount() {
            return this.cartItems?.reduce((total, item) => total + item.price * item?.quantity, 0);
        },
    },
    actions: {
        addToCart(item) {
            const existingItem = this.cartItems.find(i => i.id === item.id);
            if (existingItem) {
                existingItem.quantity++;
            } else {
                this.cartItems.push({ ...item, quantity: 1 });
            }
            this.persistCartState();
        },
        removeFromCart(itemId) {
            const index = this.cartItems.findIndex(item => item.id === itemId);
            if (index !== -1) {
                this.cartItems.splice(index, 1);
                this.persistCartState();
            }
        },
        updateQuantity({ itemId, quantity }) {
            const item = this.cartItems.find(i => i.id === itemId);
            if (item) {
                item.quantity = quantity;
                this.persistCartState();
            }
        },
        increaseQuantity(itemId) {
            const item = this.cartItems.find(i => i.id === itemId);
            if (item) {
                item.quantity++;
                this.persistCartState();
            }
        },
        decreaseQuantity(itemId) {
            const item = this.cartItems.find(i => i.id === itemId);
            if (item && item.quantity > 1) {
                item.quantity--;
                this.persistCartState();
            }
        },
        clearCart() {
            this.cartItems = [];
            this.persistCartState();
        },
        persistCartState() {
            localStorage.setItem(Offer_STORAGE_KEY, JSON.stringify(this.cartItems));
        },
    },
});
