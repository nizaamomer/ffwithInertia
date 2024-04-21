import { defineStore } from 'pinia';

const CART_STORAGE_KEY = 'cartItems';

export const useFoodCartStore = defineStore('cart', {
    state: () => ({
        cartItems: JSON.parse(localStorage.getItem(CART_STORAGE_KEY)) || [],
    }),
    getters: {
        totalItems() {
            return this.cartItems.length;
        },
        totalAmount() {
            return this.cartItems.reduce((total, item) => total + item.price * item.quantity, 0);
        },
    },
    actions: {
        addToCart({ item, type }) {
            const existingItemIndex = this.cartItems.findIndex(i => i.id === item.id && i.type === type);
            if (existingItemIndex !== -1) {
                this.cartItems[existingItemIndex].quantity++;
            } else {
                this.cartItems.push({ ...item, quantity: 1, type });
            }
            this.persistCartState();
        },
        removeFromCart({ itemId, type }) {
            const itemIndex = this.cartItems.findIndex(i => i.id === itemId && i.type === type);
            if (itemIndex !== -1) {
                this.cartItems.splice(itemIndex, 1);
                this.persistCartState();
            }
        },
        updateQuantity({ itemId, quantity, type }) {
            const itemIndex = this.cartItems.findIndex(i => i.id === itemId && i.type === type);
            if (itemIndex !== -1) {
                const item = this.cartItems[itemIndex];
                item.quantity = quantity;
                this.persistCartState();
            }
        },
        increaseQuantity({ itemId, type }) {
            const itemIndex = this.cartItems.findIndex(i => i.id === itemId && i.type === type);
            if (itemIndex !== -1) {
                const item = this.cartItems[itemIndex];
                item.quantity++;
                this.persistCartState();
            }
        },
        decreaseQuantity({ itemId, type }) {
            const itemIndex = this.cartItems.findIndex(i => i.id === itemId && i.type === type);
            if (itemIndex !== -1) {
                const item = this.cartItems[itemIndex];
                if (item.quantity > 1) {
                    item.quantity--;
                    this.persistCartState();
                }
            }
        },
        clearCart() {
            this.cartItems = [];
            this.persistCartState();
        },
        persistCartState() {
            localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(this.cartItems));
        },
    },
});
