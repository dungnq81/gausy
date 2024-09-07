import { loadStyle, loadDynamicChunk } from 'blocksy-frontend'
import ctEvents from 'ct-events'

function whenTransitionEnds(el, cb) {
	setTimeout(() => {
		cb()
	}, 300)
	return
}

export const fetchAddToCartPopupContent = async (content) => {
	const div = document.createElement('div')
	div.innerHTML = content

	const popupContent = div.firstElementChild

	if (!ct_localizations.dynamic_styles.added_to_cart_popup) {
		return
	}

	ctEvents.trigger('ct:sync:added-to-cart-popup', {
		popup: popupContent,
	})

	loadStyle(ct_localizations.dynamic_styles.added_to_cart_popup).then(() => {
		document.querySelector('.ct-drawer-canvas').appendChild(popupContent)

		const popup = document.querySelector('#ct-added-to-cart-popup')

		setTimeout(() => ctEvents.trigger('ct:flexy:update'))

		popup.unmount = () => {
			whenTransitionEnds(popup, () => {
				popup.remove()
			})
		}

		loadDynamicChunk('blocksy_pro_micro_popups')
			.then(({ chunk: { openMicroPopup } }) => {
				openMicroPopup(popup)
			})
			.catch((e) => {
				console.error(
					'Blocksy: failed to load blocksy_pro_micro_popups chunk.',
					e
				)
			})
	})
}
