<template lang="html">

    <div class="row budget-group">
        <label @dblclick="editGroup()">{{group.name}}</label>
    </div>

</template>

<script>
export default {
    props: [
        'group'
    ],
    methods: {
        editGroup: function() {
            var vm = this;
            
        }
    }
}
</script>

<style lang="css">
</style>
