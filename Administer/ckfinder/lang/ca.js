/*
 * CKFinder
 * ========
 * http://cksource.com/ckfinder
 * Copyright (C) 2007-2015, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file, and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying, or distributing this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 *
 */

/**
 * @fileOverview Defines the {@link CKFinder.lang} object for the Catalan
 *		language.
*/

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKFinder.lang['ca'] =
{
	appTitle : 'CKFinder',

	// Common messages and labels.
	common :
	{
		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, no disponible</span>',
		confirmCancel	: 'Algunes opcions s\'han canviat\r\nEstàs segur de tancar el quadre de diàleg?',
		ok				: 'Acceptar',
		cancel			: 'Cancel·lar',
		confirmationTitle	: 'Confirmació',
		messageTitle	: 'Informació',
		inputTitle		: 'Pregunta',
		undo			: 'Desfer',
		redo			: 'Refer',
		skip			: 'Ometre',
		skipAll			: 'Ometre tots',
		makeDecision	: 'Quina acció s\'ha de realitzar?',
		rememberDecision: 'Recordar la meva decisió'
	},


	// Language direction, 'ltr' or 'rtl'.
	dir : 'ltr',
	HelpLang : 'ca',
	LangCode : 'ca',

	// Date Format
	//		d    : Day
	//		dd   : Day (padding zero)
	//		m    : Month
	//		mm   : Month (padding zero)
	//		yy   : Year (two digits)
	//		yyyy : Year (four digits)
	//		h    : Hour (12 hour clock)
	//		hh   : Hour (12 hour clock, padding zero)
	//		H    : Hour (24 hour clock)
	//		HH   : Hour (24 hour clock, padding zero)
	//		M    : Minute
	//		MM   : Minute (padding zero)
	//		a    : Firt char of AM/PM
	//		aa   : AM/PM
	DateTime : 'dd/mm/yyyy H:MM',
	DateAmPm : ['AM', 'PM'],

	// Folders
	FoldersTitle	: 'Carpetes',
	FolderLoading	: 'Carregant...',
	FolderNew		: 'Si us plau, escriu el nom per la nova carpeta: ',
	FolderRename	: 'Si us plau, escriu el nom per la carpeta: ',
	FolderDelete	: 'Estàs segur que vols esborrar la carpeta "%1"?',
	FolderRenaming	: ' (Canviant el nom...)',
	FolderDeleting	: ' (Esborrant...)',
	DestinationFolder	: 'Carpeta de destinació',

	// Files
	FileRename		: 'Si us plau, escriu el nom del fitxer: ',
	FileRenameExt	: 'Estàs segur de canviar la extensió del fitxer? El fitxer pot quedar inservible.',
	FileRenaming	: 'Canviant el nom...',
	FileDelete		: 'Estàs segur d\'esborrar el fitxer "%1"?',
	FilesDelete	: 'Estàs segur d\'esborrar els %1 fitxers?',
	FilesLfitxer(s).',
	500 : 'El navegador de fitxers està deshabilitat per raons de seguretat. Si us plau, contacti amb l\'administrador del sistema i comprovi el fitxer de configuració de CKFinder.',
	501 : 'El suport per a icones està deshabilitat.'
	},

	// Other Error Messages.
	ErrorMsg :
	{
		FileEmpty		: 'El nom del fitxer no pot estar buit.',
		FileExists		: 'El fitxer %s ja existeix.',
		FolderEmpty		: 'El nom de la carpeta no pot estar buit.',
		FolderExists	: 'La carpeta %s ja existeix.',
		FolderNameExists	: 'La carpeta ja existeix.',

		FileInvChar		: 'El nom del fitxer no pot contenir cap dels caràcters següents: \n\\ / : * ? " < > |',
		FolderInvChar	: 'El nom de la carpeta no pot contenir cap dels caràcters següents: \n\\ / : * ? " < > |',

		PopupBlockView	: 'No ha estat possible obrir el fitxer en una nova finestra. Si us plau, configuri el seu navegador i desactivi tots els blocadors de finestres per a aquesta pàgina.',
		XmlError		: 'No ha estat possible carregar correctament la resposta XML del servidor.',
		XmlEmpty		: 'No ha estat possible carregar correctament la resposta XML del servidor. El servidor ha enviat una cadena buida.',
		XmlRawResponse	: 'Resposta del servidor: %s'
	},

	// Imageresize plugin
	Imageresize :
	{
		dialogTitle		: 'Redimensionar %s',
		sizeTooBig		: 'No es pot posar l\'altura o l\'amplada de la imatge més gran que les dimensions originals (%size).',
		resizeSuccess	: 'Imatge redimensionada correctament.',
		thumbnailNew	: 'Crear nova miniatura',
		thumbnailSmall	: 'Petita (%s)',
		thumbnailMedium	: 'Mitjana (%s)',
		thumbnailLarge	: 'Gran (%s)',
		newSize			: 'Establir nova grandària',
		width			: 'Amplada',
		height			: 'Altura',
		invalidHeight	: 'Altura invàlida.',
		invalidWidth	: 'Amplada invàlida.',
		invalidName		: 'Nom no vàlid.',
		newImage		: 'Crear nova imatge',
		noExtensionChange : 'L\'extensió no es pot canviar.',
		imageSmall		: 'La imatge original és massa petita.',
		contextMenuName	: 'Redimensionar',
		lockRatio		: 'Proporcional',
		resetSize		: 'Grandària Original'
	},

	// Fileeditor plugin
	Fileeditor :
	{
		save			: 'Desar',
		fileOpenError	: 'No es pot obrir el fitxero.',
		fileSaveSuccess	: 'Fitxer desat correctament.',
		contextMenuName	: 'Editar',
		loadingFile		: 'Carregant fitxer, si us plau, esperi...'
	},

	Maximize :
	{
		maximize : 'Maximitzar',
		minimize : 'Minimitzar'
	},

	Gallery :
	{
		current : 'Imatge {current} de {total}'
	},

	Zip :
	{
		extractHereLabel	: 'Extreure aquí',
		extractToLabel		: 'Extreure a...',
		downloadZipLabel	: 'Descarregar en zip',
		compressZipLabel	: 'Comprimir en zip',
		removeAndExtract	: 'Eliminar els existents i extreure',
		extractAndOverwrite	: 'Extreure sobreescrivint els fitxers existents',
		extractSuccess		: 'Fitxer extret correctament.'
	},

	Search :
	{
		searchPlaceholder : 'Cerca'
	}
};
