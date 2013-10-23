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
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @transient
	 */
	protected $falMediaPreviews;

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
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getFalMediaPreviews() {
		if ($this->falMediaPreviews === NULL) {
			$this->falMediaPreviews = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
			/** @var $mediaItem \TYPO3\CMS\Extbase\Domain\Model\FileReference */
			foreach ($this->falMedia as $mediaItem) {
				if ($mediaItem->getOriginalResource()->getProperty('showinpreview')) {
					$this->falMediaPreviews->attach($mediaItem);
				}
			}
		}
		return $this->falMediaPreviews;
	}
}