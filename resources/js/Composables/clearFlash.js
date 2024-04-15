import { watch } from 'vue';

export default function useClearFlash(flash) {
    const clearFlash = () => {
        flash.value = {};
    };

    watch(flash, () => {
        if (Object.keys(flash.value).length > 0) {
            setTimeout(clearFlash, 4000);
        }
    });
}
