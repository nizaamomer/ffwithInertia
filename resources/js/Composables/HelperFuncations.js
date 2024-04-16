export default function useHelperFuncation() {
    const getFirstLetter = (name) => {
        if (typeof name !== "string") {
            return "";
        }
        const words = name.split(" ");
        let letter = "";
        for (const word of words) {
            letter += word[0]?.toUpperCase();
        }
        return letter;
    };

    return {
        getFirstLetter
    };
}
