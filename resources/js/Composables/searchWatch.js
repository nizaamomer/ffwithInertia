import { watch } from 'vue';
import debounce from "lodash/debounce";
import { router } from '@inertiajs/vue3';
export default function useSearch(search, routeName) {
    watch(
        search,
        debounce((newvalue) => {
            router.get(
                `/${routeName}`,
                {
                    search: newvalue,
                },
                {
                    preserveState: true,
                    preserveScroll: true,
                    replace: true,
                    only: [routeName],
                }
            );
        }, 500)
    );

}
