<template lang="html">

    <div class="row budget-group" :class="{editing: true == editing}">
        <label @dblclick="editing = true">{{group.name}}</label> 
        <input type="text" v-on:blur="editGroup(group.id)" v-model="group.name">
        <i class="fa fa-times" aria-hidden="true" @click="deleteGroup(group)"></i>
    </div>

</template>

<script>
export default {
    props: [
        'group'
    ],
    data () {
        return {
            status: null,
            editing: false

        }
    },
    computed: {
    },
    methods: {
        editGroup: function(id) {
            let vm = this;
            this.editing = false;
            axios.patch('/budget_groups/' + id, vm.group)
            .then(function(res){
                console.log(res);
            }).catch(function(err) {
                console.log(err);
            });

        },
        deleteGroup: function(group) {
            let vm = this;

            axios.delete('/budget_groups/' + group.id, {
                method: 'delete'
            })
            .then(function(res){
                console.log(res);
            }).catch(function(err){
                console.log(err);
            });
        }
    }
}
</script>
