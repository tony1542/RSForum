<template>
    <transition
        name="modal"
    >
        <div
            v-show="show"
            class="modal-mask"
        >
            <div class="modal-wrapper">
                <div
                    class="modal-container"
                    @keydown.esc="emitClose"
                >
                    <div
                        class="modal-header flex justify-between"
                    >
                        <slot name="header" />
                        <span
                            class="cursor-pointer"
                            @click="emitClose"
                        >
                            x
                        </span>
                    </div>
					
                    <div class="modal-body">
                        <slot name="body">
                            default body
                        </slot>
                    </div>
					
                    <div
                        class="modal-footer"
                    >
                        <slot name="footer" />
                        <button
                            @click="emitClose"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "Modal",
        props: {
            show: Boolean
        },
        methods: {
            emitClose: function () {
                if (!this.show) {
                    return;
                }
				
                this.$emit('close');
            }
        }
    }
</script>

<style>
.modal-mask {
	position: fixed;
	z-index: 9998;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: rgba(0, 0, 0, 0.5);
	display: table;
}

.modal-wrapper {
	display: table-cell;
	vertical-align: middle;
}

.modal-container {
	width: 300px;
	margin: 0px auto;
	padding: 20px 30px;
	background-color: var(--background-color-secondary);
	border-radius: 2px;
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
}

.modal-body {
	margin: 20px 0;
}

</style>