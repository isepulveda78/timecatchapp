<template>
    <div>
        <div class="form-group">
            <label :for="name">{{ label }}</label>
            <input class="form-control" :id="name" type="text" :placeholder="placeholder" v-model="value" autocomplete="off" :class="errorClassObject()" @input="updateField()">
                <p v-text="errorMessage()">Needs to be filled.</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "InputField",
    props: [
        'name', 'label', 'placeholder', 'errors', 'data'
    ],
    data: function()
    {
        return {
            value: ''
        }
    },
    computed: {
        hasError: function() {
            return this.errors && this.errors[this.name] && this.errors[this.name].length > 0;
        }
    },
    methods: {
        updateField: function(){
            this.clearErrors(this.name)

            this.$emit('update:field', this.value)
        },
        errorMessage: function(){
            if(this.hasError){
                return this.errors[this.name][0]
            }
        },
        clearErrors: function(){
            if(this.hasError){
                this.errors[this.name] = null;
            }
        },
        errorClassObject: function(){
            return {
                'error-field': this.hasError
            }
        }
    },
    watch: {
        data: function(val){
            this.value = val;
        }
    }
}
</script>