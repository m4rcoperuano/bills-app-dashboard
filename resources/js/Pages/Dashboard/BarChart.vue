<template>
    <div class="py-6">
        <h1 class="text-2xl pl-3 pb-4 font-bold">
            Grand Total Expenses By Month
        </h1>
        <line-chart :data="ledgerEntriesByPeriod"
            thousands=","
            prefix="$"></line-chart>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        components: {
        },
        props: {
            ledgerEntriesGroupedByMonth: {
                type: Array,
                required: true
            }
        },
        computed: {
            ledgerEntriesByPeriod() {
                return this.ledgerEntriesGroupedByMonth.map( ledgerEntry => {
                    let date = moment( ledgerEntry.startDate ).format( 'MMMM YYYY' );
                    return {
                        date,
                        amount: ledgerEntry.ledgerEntries.reduce( ( accum, entry ) => {
                            if ( entry.type === 'debit' )
                                return parseFloat( entry.amount ) + parseFloat( accum );
                            else {
                                return parseFloat( accum ) - parseFloat( entry.amount );
                            }
                        }, 0 )
                    };
                } ).reduce( ( chartData, data ) => {

                    let dateKey = data.date;
                    let amountValue = data.amount;
                    let newObject = {};
                    newObject[dateKey] = Math.round( amountValue * 100 ) / 100;

                    return { ...chartData, ...newObject };
                }, {} );
            }
        }
    };
</script>

<style scoped>

</style>
