# News FAL Image Field

## About

Adds FAL file field to news for further FE render via Fluid.

## Installation

Just install the extension and it will add new media field to your news items.

## Use

All images
/Resources/Private/Partials/Detail/Item.html
	<f:for each="{newsItem.falMedia}" as="image">
		<f:image src="{image.uid}" alt="{f:if(condition: '{image.originalResource.alternative}', then: '{image.originalResource.alternative}', else: '{image.originalResource.title}')}" width="200" treatIdAsReference="1"/>
		<f:format.html>
			image.uid : {image.uid}
			image.identifier : {image.originalResource.identifier}
			image.public_url : {image.originalResource.publicUrl}
			image.title : {image.originalResource.title}
			image.alternative : {image.originalResource.alternative}
			image.description : {image.originalResource.description}
			image.extension : {image.originalResource.extension}
			image.type : {image.originalResource.type}
			image.mimeType : {image.originalResource.mimeType}
			image.size : {image.originalResource.size}
			image.creationTime : {image.originalResource.creationTime}
			image.modificationTime : {image.originalResource.modificationTime}
		</f:format.html>
	</f:for>

Only the images marked as preview
	<f:for each="{newsItem.falMediaPreviews}" as="image">
		<f:image src="{image.uid}" alt="{f:if(condition: '{image.originalResource.alternative}', then: '{image.originalResource.alternative}', else: '{image.originalResource.title}')}" width="200" treatIdAsReference="1"/>
	</f:for>
	
## Ressources used during development

* http://docs.typo3.org/typo3cms/extensions/news/latest/Main/Tutorial/ExtendingNews/Index.html
* http://buzz.typo3.org/teams/extbase/article/fal-and-extbase-the-easy-part/
* https://gist.github.com/fedir/6029864
* http://t3brightside.com/blog/article/extending-extnews-with-a-fal-compilant-audio-and-customized-youtube-video/
