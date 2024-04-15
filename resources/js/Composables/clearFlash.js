import { watch } from 'vue';

export default function useClearAfterTimeout(value) {
    const clearAfterTimeout = () => {
        if (value.message) {
            setTimeout(() => {
                value.message = "";
            }, 4000);
        }
        if (value.error) {
            setTimeout(() => {
                value.error = "";
            }, 4000);
        }
    };

    watch(() => [value.message, value.error], clearAfterTimeout);

    return {
        clearAfterTimeout
    };
}
