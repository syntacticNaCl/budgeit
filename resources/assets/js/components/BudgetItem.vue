<template>
    <tr>
        <td :class="{editing: true == editingName}">
            <label @dblclick="editingName = true">{{item.name}}</label>
            <input type="text" v-on:blur="editingName = false; editItem()" v-model="item.name">
        </td>
        <td :class="{editing: true == editingAmount}">
            <label @dblclick="editingAmount = true">{{amountString}}</label>
            <input type="text" v-on:blur="editingAmount = false; editItem()" v-model="item.amount">
        </td>
        <td>
            <i class="fa fa-times pull-right" aria-hidden="true" @click="deleteItem()"></i>
        </td>
    </tr>
</template>

<script>
    const accounting = require('accounting');

    export default {
        props: [
            'item'
        ],
        data() {
            return {
                editingName: false,
                editingAmount: false
            }
        },
        computed: {
            amountString() {
                // var amount = this.item.amount;
                // amount = parseInt(amount.replace(/[^0-9]/, ''));
                
                // this.amountInt = parseInt(this.item.amount.toString().replace(/[^0-9]/, ''));
                return accounting.formatMoney(this.item.amount);
            }
        },
        methods: {
            editItem() {
                let vm = this;
                this.editingName = false;
    
                axios.patch('budget_items/' + this.item.id, {
                    id: vm.item.id,
                    name: vm.item.name,
                    amount: parseFloat(vm.item.amount),
                    type: vm.item.type
                }).then(res => {
                    console.log(res);
                }).catch(err => {
                    console.log(err);
                });
            },
            deleteItem: function() {
                let vm = this;

                axios.delete('budget_items/' + this.item.id)
                    .then(function(res){
                        console.log(res);
                    }).catch(function(err){
                        console.log(err);
                    });
            }
    
        }
    }
</script>