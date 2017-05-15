<?php

namespace Sajari;

class Schema
{
    private $grpcSchemaClient;
    private $callMeta;

    /**
     * Schema constructor.
     *
     * @param Engine\Schema\SchemaClient $grpcSchemaClient Schema grpc Client.
     * @param array $callMeta Array of meta data to send with requests.
     */
    public function __construct(
        Engine\Schema\SchemaClient $grpcSchemaClient,
        array $callMeta
    )
    {
        $this->grpcSchemaClient = $grpcSchemaClient;
        $this->callMeta = $callMeta;
    }

    /**
     * Returns a list of the fields defined in the schema.
     *
     * @return Field[].
     */
    public function getFields()
    {
        /** @var \Sajari\Engine\Schema\Fields $reply */
        list($reply, $status) = $this->grpcSchemaClient->GetFields(
            new Rpc\PBEmpty(),
            $this->callMeta
        )->wait();

        Internal\Status::fromRpcCallStatus($status)->throwIfError();

        $fields = [];
        foreach ($reply->getFields() as $field) {
            $fields[] = Internal\Field::fromProto($field);
        }
        return $fields;
    }

    /**
     * Add fields to the schema.
     *
     * @param Field[] $fields Fields to add.
     * @return Status[] Array of Status objects.
     */
    public function addFields(array $fields)
    {
        $protoFields = new Engine\Schema\Fields();
        foreach ($fields as $field) {
            $protoFields->getFields()[] = Internal\Field::toProto($field);
        }

        list($resp, $status) = $this->grpcSchemaClient->AddFields(
            $protoFields,
            $this->callMeta
        )->wait();

        Internal\Status::fromRpcCallStatus($status)->throwIfError();

        return Internal\Status::fromProtoStatuses($resp->getStatus());
    }

    /**
     * Mutate a schema field.
     *
     * @param string $name The name of the field.
     * @param FieldMutation The mutations to apply to the field.
     */
    public function mutateField($name, FieldMutations $mutations) {
        $protoRequest = new \Sajari\Engine\Schema\MutateFieldRequest();
        $protoRequest->setName($name);
        $protoMutations = $mutations->getMutations();
        $protoRequest->setMutations($protoMutations);

        list($resp, $status) = $this->grpcSchemaClient->MutateField(
            $protoRequest,
            $this->callMeta
        )->wait();

        Internal\Status::fromRpcCallStatus($status)->throwIfError();
    }
}
