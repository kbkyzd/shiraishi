<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Transactions</div>

                    <div class="panel-body">
                        <ul>
                            <li v-for="transaction in transactions">
                                {{ transaction }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data: () => {
            return {
                'transactions': ''
            }
        },
        mounted() {
            Echo.private(`App.User.${this.user}`)
                .listen('TransactionProcessed', e => {
                    console.log('Hit!');
                    console.table(e);
                });

            console.log(`Listening for events on App.User.${this.user}`);
        }

    }
</script>
