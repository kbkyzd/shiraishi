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
                'transactions': []
            }
        },
        mounted() {
            Notification.requestPermission();
            Echo.private(`App.User.${this.user}`)
                .listen('TransactionProcessed', e => {
                    console.log('Hit!');
                    console.table(e);
                    this.spawnNotification('Received notification from ' + e.user.name, '/favicon.ico', 'Notification received');
                    this.transactions.push(e);
                });

            console.log(`Listening for events on App.User.${this.user}`);
        },
        methods: {
            spawnNotification(body, icon, title) {
                var options = {
                    body: body,
                    icon: icon
                }
                var n = new Notification(title, options);
                setTimeout(n.close.bind(n), 5000);
            }
        }

    }
</script>
