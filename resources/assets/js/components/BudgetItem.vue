<template>
    <tr>
        <td :class="{editing: true == editingName}">
            <label @dblclick="editingName = true">{{item.name}}</label>
            <input type="text" v-on:blur="editingName = false; editItem()" v-model="item.name">
        </td>
        <td :class="{editing: true == editingAmount}">
            <label @dblclick="editingAmount = true">{{item.amount}}</label>
            <input type="text" v-on:blur="editingAmount = false; editItem()" v-model="item.amount">
        </td>
    </tr>
</template>

<script>
    export default {
        props: [
            'item'
        ],
        data() {
            return {
                editingName: false,
                editingAmount: false,
            }
        },
        computed: {},
        methods: {
            editItem: function() {
                let vm = this;
                this.editingName = false;
    
                axios.patch('budget_items/' + this.item.id, {
                    id: vm.item.id,
                    name: vm.item.name,
                    amount: vm.item.amount,
                    type: vm.item.type
                }).then(function(res) {
                    console.log(res);
                }).catch(function(err) {
                    console.log(err);
                });
            }
    
        }
    }
</script>