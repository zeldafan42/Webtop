<?xml version='1.0' encoding='UTF-8'?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<div><xsl:apply-templates></xsl:apply-templates></div>
		</xsl:template>
	<xsl:template match="channel/title">
		<h1><xsl:value-of select="."></xsl:value-of></h1>
		</xsl:template><xsl:template match="item/title">
		
		<h2><xsl:value-of select="."></xsl:value-of></h2></xsl:template>
	<xsl:template match="link">
		
		<p><a href="{.}">
			<xsl:value-of select="."></xsl:value-of></a></p></xsl:template><xsl:template match="author">
		
		<p><xsl:value-of select="."></xsl:value-of></p></xsl:template><xsl:template match="description">
		
		<p><xsl:value-of select="."></xsl:value-of></p></xsl:template><xsl:template match="category">
		
		<p><xsl:value-of select="."></xsl:value-of></p></xsl:template></xsl:stylesheet>