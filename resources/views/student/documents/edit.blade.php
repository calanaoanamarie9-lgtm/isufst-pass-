@include('student.documents._form', [
    'action' => route('student.documents.update', $documentRequest),
    'method' => 'PUT',
    'submit' => 'Save Changes',
    'documentRequest' => $documentRequest,
    'documents' => $documents,
    'purposeTypes' => $purposeTypes,
    'educationalStatuses' => $educationalStatuses,
    'educationalLevels' => $educationalLevels,
    'claimModes' => $claimModes,
    'profile' => $profile,
])