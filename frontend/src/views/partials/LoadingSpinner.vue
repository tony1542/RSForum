<template>
	<div>
		<svg
			height="40px"
			style="enable-background:new 0 0 50 50;"
			viewBox="0 0 50 50"
			width="40px"
			x="0px"
			xml:space="preserve"
			y="0px"
		>
            <path
	            d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z"
	            fill="#000"
            >
                <animateTransform
	                attributeName="transform"
	                attributeType="xml"
	                dur="0.6s"
	                from="0 25 25"
	                repeatCount="indefinite"
	                to="360 25 25"
	                type="rotate"
                />
            </path>
        </svg>
	</div>
</template>

<script>
export default {
	name: "LoadingSpinner"
}
</script>

<style scoped>
svg path {
	fill: var(--primary);
}
</style>