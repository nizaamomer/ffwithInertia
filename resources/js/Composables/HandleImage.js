import { ref } from 'vue';

export default function useHandleImage(user) {
    const imageUrl = ref(null);
    const handleImageChange = (event) => {
        const file = event.target.files[0];
        if (file) {
            user.image = file;
            imageUrl.value = URL.createObjectURL(file);
        } else {
            user.image = null;
            imageUrl.value = null;
        }
    };
    return {
        handleImageChange,
        imageUrl
    };
}
