<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
  <html>
      <head>
        <link href="../css/styles.css" type="text/css" rel="stylesheet" />
    </head>
  <body>
      <div class="center">
    
      <xsl:for-each select="mixedteams/basketball">
          <xsl:variable name="bgColor">
                <xsl:value-of select="BColor"/>
            </xsl:variable>
          <xsl:variable name="Color">
                <xsl:value-of select="Color"/>
            </xsl:variable>
      <table border="1" bgcolor="{$bgColor}" style="color:{$Color};">
      <tr>
        <td colspan="4"><xsl:value-of select="Team"/></td>
      </tr>
      <tr>
        <td rowspan="2"> 
                <img>
                    <xsl:attribute name="width">
                        50
                    </xsl:attribute>
                    <xsl:attribute name="height">
                        50
                    </xsl:attribute>
                    <xsl:attribute name="src">
                        <xsl:value-of select="Image"/>
                    </xsl:attribute>
                </img>
          </td>
        <td>All-star</td>
        <td>Coach</td>
        <td>Stadium</td>
      </tr>
      <tr>
          <td>
              <table border="1" style="color:{$Color};">
                  <tr>
                    <td><xsl:value-of select="All-star/name"/></td>
                    <td><xsl:value-of select="All-star/age"/></td>
                    <td><xsl:value-of select="All-star/position"/></td>
                  </tr>
              </table>
          </td>
          <td><xsl:value-of select="Coach"/></td>
          <td><xsl:value-of select="Stadium"/></td>
      </tr>
    <tr>
        <td colspan="4">
            <xsl:element name="iframe">
                <xsl:attribute name="width">
                    640
                </xsl:attribute>
                <xsl:attribute name="height">
                    430
                </xsl:attribute>
                <xsl:attribute name="src">
                    <xsl:value-of select="Video"/>
                </xsl:attribute>
                <xsl:attribute name="frameborder">0</xsl:attribute>
            </xsl:element>
        </td>
      </tr>
    </table>
      </xsl:for-each>
   
      </div>
  </body>
  </html>
</xsl:template>
</xsl:stylesheet>

