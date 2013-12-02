<?php

class Tx_Newsfal_Domain_Model_News extends Tx_News_Domain_Model_News {

	/**
	 * Fal media items
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @lazy
	 */
	protected $falMedia;

	/**
	 * Fal media items with showinpreview set
	 *
	 * @var array
	 * @transient
	 */
	protected $falMediaPreviews;

	/**
	 * Fal related files
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @lazy
	 */
	protected $falRelatedFiles;

	/**
	 * Get the Fal media items
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getFalMedia() {
		return $this->falMedia;
	}

	/**
	 * Get the Fal media items
	 *
	 * @var array
	 */
	public function getFalMediaPreviews() {
		if ($this->falMediaPreviews === NULL && $this->falMedia !== NULL) {
			$this->falMediaPreviews = array();
			/** @var $mediaItem \TYPO3\CMS\Extbase\Domain\Model\FileReference */
			foreach ($this->falMedia as $mediaItem) {
				if ($mediaItem->getOriginalResource()->getProperty('showinpreview')) {
					$this->falMediaPreviews[] = $mediaItem;
				}
			}
		}
		return $this->falMediaPreviews;
	}

	/**
	 * Get first media element which is tagged as preview and is of type image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	public function getFirstFalImagePreview() {

		$mediaElements = $this->getFalMediaPreviews();
		if (is_array($mediaElements)) {
			foreach ($mediaElements as $mediaElement) {
					return $mediaElement;
			}
		}
		return NULL;
	}

	/**
	 * Get Fal Related Files
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getFalRelatedFiles() {
		return $this->falRelatedFiles;
	}
}