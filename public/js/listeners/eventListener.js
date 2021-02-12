export default class EventListener {
    /**
     * Implementation required
     */
    register() {
        throw new Error('Must implement the register method.');
    }

    /**
     * @param {Array.<EventListener>}listeners_to_register
     */
    static registerListeners(listeners_to_register) {
        for (let i = 0; i < listeners_to_register.length; i++) {
            listeners_to_register[i].register();
        }
    }
}
