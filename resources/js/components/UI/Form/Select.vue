<template>
    <select v-model="value">
        <option v-for="option in options" :value="option.value">{{ option.text }}</option>
    </select>
</template>

<script>
export default {
    props: {
        options: Object, //{text, value},
        default: {
            type: [String, Number],
            default: ""
        }
    },
    data() {
        return {
            value: ""
        }
    },
    computed: {
        change: {
            get() {
                return this.value;
            },
            set(val) {
                this.$emit('input', val);
            }
        }
    },
    created() {
        this.value = this.default;
    }
}
</script>

<style scoped>
select {
    border-radius: 10px;
    border: 1px solid #808080;
    background: #F4F4F4;
    padding: 20px 30px;
    color: #808080;
    font-family: Raleway;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 130%;
    width: 100%;
    background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIiIGhlaWdodD0iNyIgdmlld0JveD0iMCAwIDEyIDciIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGlkPSJWZWN0b3IgMyIgZD0iTTAuODM1OTM4IDFMNS44MzU5NCA2TDEwLjgzNTkgMC45OTk5OTkiIHN0cm9rZT0iIzM5MzkzOSIvPgo8L3N2Zz4K') no-repeat;
    background-position: calc(100% - 0.75rem) center !important;
    -moz-appearance:none !important;
    -webkit-appearance: none !important;
    appearance: none !important;
    padding-right: 2rem !important;
}


</style>
