<template>

</template>

<script>
    import Instascan from 'instascan';

    export default {
        props: ['user'],
        data: () => {
            return {
                scanner: null,
                activeCameraId: null,
                cameras: [],
                scans: []
            }
        },
        mounted() {
            const self = this;
            this.scanner = new Instascan.Scanner({
                video: document.getElementById('preview'),
                scanPeriod: 5,
                mirror: false,
            });

            this.scanner.addListener('scan', (content, image) => {
                self.scans.unshift({
                    date: +(Date.now()),
                    content: content
                });
            });

            Instascan.Camera.getCameras().then(function(cameras) {
                self.cameras = cameras;
                if (cameras.length > 0) {
                    self.activeCameraId = cameras[0].id;
                    self.scanner.start(cameras[0]);
                } else {
                    console.error('No cameras found.');
                }
            }).catch(e => {
                console.error(e);
            });
        },
        methods: {
            formatName(name) {
                return name || '(unknown)';
            },
            selectCamera(camera) {
                this.activeCameraId = camera.id;
                this.scanner.start(camera);
            }
        }
    }
</script>
